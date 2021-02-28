import React, {useEffect, useState} from 'react'
import {render, unmountComponentAtNode} from 'react-dom'
import {usePaginatedFetch} from "./hook";
import Table from './mission_table';
import Pagination from "./mission_table_pagination";
import Loader from "react-loader-spinner";

// Le composant react a afficher
function TableMissions() {
    const url = '/api/missions'
    const {items: missions, load, loading, nbrPages} = usePaginatedFetch(url)

    const [currentPage, setCurrentPage] = useState(1)

    useEffect(() => {
        load()
    }, [])

    const handleClickOnPageNumber = index => {
        load(`${url}?page=${index}`)
        setCurrentPage(index)
    }

    return <div>
        {loading && <Loader type="BallTriangle" color="#00BFFF" height={80} width={80}/>}
        <Table missions={missions}/>

        <Pagination nbrPages={nbrPages} currentPage={currentPage} handleClick={handleClickOnPageNumber}/>
    </div>
}

// Creation d'un custom elements pour faire un code plus propre et eviter de preciser où react doit ce connecter
class MissionIndexController extends HTMLElement {
    connectedCallback() {
        render(<TableMissions/>, this)
    }

    disconnectedCallback() {
        unmountComponentAtNode(this)
    }
}

if (!customElements.get('table-missions')) {
    customElements.define('table-missions', MissionIndexController);
}

