import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import FavoriteBook from './FavoriteBook';

document.addEventListener('DOMContentLoaded', () => {
    const rootElement = document.getElementById('root-shortcode');

    if (!rootElement) {
        console.error('No se encontró #root-shortcode en el DOM.');
        return;
    }

    const root = ReactDOM.createRoot(rootElement);
    root.render(
        <React.StrictMode>
            <FavoriteBook />
        </React.StrictMode>
    );
});
