import {useCallback, useState} from 'react'

export function usePaginatedFetch(url) {
  const [loading, setLoading] = useState(false)
  const [items, setItems] = useState([])
  // on defini la variable qui nous permettra de faire le systeme de pagination
  const [nbrPages, setNbrPages] = useState(null)
  const load = useCallback(async (loadUrl) => {
    setLoading(true)

    try {
      const response = await jsonLdFetch(loadUrl || url)
      setItems(response['hydra:member'])

      // On calcule le nombre de page en divisant le nombre de missions totales par le nombre d'éléments renvoyé
      // de cette façon si on change depuis le back office le nombre d'éléments renvoyé la pagination s'adapte
      // on verifie également s'il y a besoin d'une pagination
      if (nbrPages === null) {
        const actualPageNumber = response['hydra:view']['@id'].split('?page=')[1]
        const lastPageNumber = response['hydra:view']['hydra:last'].split('?page=')[1]
        // On evite de faire cette logique si c'est la derniere page pour eviter les soucis
        if (actualPageNumber !== lastPageNumber) {
          if (response['hydra:totalItems'] > response['hydra:member'].length) {
            setNbrPages(Math.ceil(response['hydra:totalItems'] / response['hydra:member'].length))
          }
        }
      }
    } catch (error) {
      console.error(error)
    }

    setLoading(false)
  }, [url])

  return {
    items,
    load,
    loading,
    nbrPages
  }
}

async function jsonLdFetch(url) {
  const params = {
    method: 'GET',
    headers: {
      'Accept': 'application/ld+json'
    }
  }

  const response = await fetch(url, params)

  const responseData = await response.json()

  if (response.ok) {
    return responseData
  } else {
    throw responseData
  }

}
