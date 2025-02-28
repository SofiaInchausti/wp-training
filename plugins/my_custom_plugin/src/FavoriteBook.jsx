import React, { useEffect, useState } from 'react';

const FavoriteBook = () => {
    const [favoriteBook, setFavoriteBook] = useState(null);
    const [newFavoriteBook, setNewFavoriteBook] = useState('');
    const [isSaving, setIsSaving] = useState(false);

    useEffect(() => {
        // Fetch the 'Favorite Book' from the custom REST API
        fetch('/wp-json/my-custom-plugin/v1/favorite-book')
            .then((response) => response.json())
            .then((data) => setFavoriteBook(data.favorite_book)) // Assumed 'favorite_book' is returned
            .catch((error) =>
                console.error('Error fetching the favorite book:', error)
            );
    }, []);

    const handleInputChange = (e) => {
        setNewFavoriteBook(e.target.value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        if (!newFavoriteBook) return; // Don't proceed if input is empty

        setIsSaving(true);

        // Make a POST request to save the new favorite book
        fetch('/wp-json/my-custom-plugin/v1/favorite-book', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ favorite_book: newFavoriteBook }),
        })
            .then((response) => response.json())
            .then(() => {
                setIsSaving(false);
                setFavoriteBook(newFavoriteBook);
                setNewFavoriteBook('');
            })
            .catch((error) => {
                setIsSaving(false);
                console.error('Error saving the favorite book:', error);
            });
    };

    if (favoriteBook === null) {
        return <div>Loading...</div>;
    }

    return (
        <div className="bg-white p-6 rounded-lg shadow-md max-w-md mt-8">
            <h2 className="text-2xl font-semibold text-indigo-700 text-center mb-4">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="yellow"
                    width={20}
                    height={20}
                    className="inline-block mr-2"
                >
                    <path d="M12 17.75l-5.26 3.14 1.43-6.13-4.72-4.1 6.23-.54L12 4l2.32 6.12 6.23.54-4.72 4.1 1.43 6.13z" />
                </svg>
                Favorite Book
            </h2>
            <p className="text-gray-600 text-center text-lg mb-6">
                {favoriteBook}
            </p>

            <form onSubmit={handleSubmit} className="space-y-4">
                <input
                    type="text"
                    value={newFavoriteBook}
                    onChange={handleInputChange}
                    placeholder="Enter your favorite book"
                    className="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
                <button
                    type="submit"
                    disabled={isSaving || !newFavoriteBook}
                    className="mt-3 w-full py-2 px-4 bg-indigo-600 text-white rounded-md focus:outline-none hover:bg-indigo-700 disabled:bg-gray-400"
                >
                    {isSaving ? 'Saving...' : 'Save Favorite Book'}
                </button>
            </form>
        </div>
    );
};

export default FavoriteBook;
