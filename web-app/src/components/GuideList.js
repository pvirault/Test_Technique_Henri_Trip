import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

const GuideList = () => {
    const [guides, setGuides] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('/api/guides')
            .then(response => {
                setGuides(response.data);
                setLoading(false);
            })
            .catch(error => console.error("Erreur de chargement des guides", error));
    }, []);

    if (loading) return <p>Chargement...</p>;

    return (
        <div>
            <h2>Liste des Guides</h2>
            <ul>
                {guides.map(guide => (
                    <li key={guide.id}>
                        <Link to={`/guides/${guide.id}`}>{guide.title}</Link>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default GuideList;
