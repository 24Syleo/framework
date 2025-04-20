// fetchService.js
export class FetchService {
    static async get(url, params = {}) {
        const query = new URLSearchParams(params).toString();
        const finalUrl = query ? `${url}?${query}` : url;

        try {
            const response = await fetch(finalUrl, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            return await response.json();
        } catch (err) {
            console.error('GET error:', err);
            throw err;
        }
    }

    static async post(url, data) {
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });
            return await response.json();
        } catch (err) {
            console.error('POST error:', err);
            throw err;
        }
    }

    static async delete(url, data = {}) {
        try {
            const response = await fetch(url, {
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    _method: 'DELETE', // PHP trick
                    ...data
                })
            });
            return await response.json();
        } catch (err) {
            console.error('DELETE error:', err);
            throw err;
        }
    }
}
