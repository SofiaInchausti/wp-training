import React, { useEffect, useState } from 'react';

const FavoriteBook = () => {
  const [favoriteBook, setFavoriteBook] = useState(null);

  useEffect(() => {
    // Fetch the 'Favorite Book' from the custom REST API
    fetch('/wp-json/my-custom-plugin/v1/favorite-book')
      .then(response => response.json())
      .then(data => setFavoriteBook(data))
      .catch(error => console.error('Error fetching the favorite book:', error));
  }, []);

  if (favoriteBook === null) {
    return <div>Loading...</div>;
  }

  return (
    <div className="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 max-w-md mx-auto">
  
    <h2 className="text-2xl font-bold text-indigo-600 text-center mb-4">
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="yellow"
        width={20}
        height={20}
        className="w-6 h-6"
      >
        <path d="M12 17.75l-5.26 3.14 1.43-6.13-4.72-4.1 6.23-.54L12 4l2.32 6.12 6.23.54-4.72 4.1 1.43 6.13z" />
      </svg>  Favorite Book
    </h2>
    <p className="text-gray-700 leading-relaxed text-center text-lg">
      {favoriteBook.favorite_book}
    </p>
  </div>
  
  );
};

export default FavoriteBook;
