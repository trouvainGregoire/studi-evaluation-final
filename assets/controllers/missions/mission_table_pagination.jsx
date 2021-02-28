import React from "react";

export default function Pagnination({nbrPages, currentPage, handleClick}) {
    return <>
        <nav aria-label="...">
            <ul className="pagination">
                {(Array(nbrPages).fill(0).map((_, index) => (
                    <li key={index} onClick={() => handleClick(index + 1)}
                        className={`page-item cursor ${index + 1 === currentPage ? 'active' : ''}`}>
                        <a className="page-link">{index + 1}</a>
                    </li>)))}
            </ul>
        </nav>
    </>
}
