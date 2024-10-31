// client/src/App.jsx
import { useEffect, useState } from 'react';

function App() {
    const [message, setMessage] = useState('');
    
    useEffect(() => {
        fetch('/api')
            .then(response => response.json())
            .then(data => setMessage(data.message))
            .catch(error => console.error('Error:', error));
    }, []);

    return (
        <div className="App">
            <h1>{message}</h1>
        </div>
    );
}

export default App;
