import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

const GuideDetail = () => {
    const { id } = useParams();
    const [guide, setGuide] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get(`/api/guides/${id}`)
            .then(response => {
                setGuide(response.data);
                setLoading(false);
            })
            .catch(error => console.error("Erreur de chargement des détails du guide", error));
    }, [id]);

    if (loading) return <p>Chargement...</p>;
    if (!guide) return <p>Aucun guide trouvé</p>;

    return (
        <div>
            <h2>{guide.title}</h2>
            <p>{guide.description}</p>
            <h3>Jours</h3>
            <ul>
                {guide.days.map((day, index) => (
                    <li key={index}>
                        Jour {index + 1} - <Link to={`/guides/${id}/days/${index}`}>{day.name}</Link>
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default GuideDetail;
