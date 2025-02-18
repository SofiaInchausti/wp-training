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
    <div className="book-contianer">
    <h2 className="book-title">Favorite Book:</h2>
    <p className="book-text">{favoriteBook.favorite_book}</p>
  </div>
  );
};

export default FavoriteBook;
