import React from "react"
import DayJS from "react-dayjs"

export default function Table({missions}) {
    return <>
        <table className="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Start At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            {missions.map((m) => (
                <tr key={m.id}>
                    <th>{m.id}</th>
                    <th>{m.title}</th>
                    <th dangerouslySetInnerHTML={{
                        __html: m.description
                    }}></th>
                    <th>{m.status.name}</th>
                    <th><DayJS format="MMMM D, YYYY h:mm A">{m.startAt}</DayJS></th>
                    <th><a className="btn btn-primary my-2" href={`/missions/${m.id}`}>Voir</a></th>
                </tr>
            ))}
            </tbody>
        </table>

    </>
}
