import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';

const GuideList = () => {
    const [guides, setGuides] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchGuides()
            .then(data => {
                setGuides(data);
                setLoading(false);
            })
            .catch(error => {
                console.error("Erreur lors du chargement des guides", error);
                setLoading(false);
            });
    }, []);

    if (loading) return <p>Chargement...</p>;

    return (
        <div>
            <h2>Liste des Guides</h2>
            <ul>
                {guides.map(guide => (
                    <li key={guide.id}>
                        {/* <Link to={`/guides/${guide.id}`}>{guide.title}</Link> */}
                        <p>{guide.title}</p>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default GuideList;
