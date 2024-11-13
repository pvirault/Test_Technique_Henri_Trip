import axios from 'axios';

const apiUrl = process.env.REACT_APP_API_BASE_URL;
const apiKey = process.env.REACT_APP_API_KEY;

export const fetchGuides = async () => {
    try {
        const response = await axios.get(`${apiUrl}/guides`, {
            headers: {
                'Authorization': `Bearer ${apiKey}`
            }
        });
        return response.data;
    } catch (error) {
        console.error("Error loading guides", error);
        throw error;
    }
};
