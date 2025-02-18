// src/BooksList.jsx
import { useState, useEffect } from 'react';

const BooksList = () => {
  const [books, setBooks] = useState([]);       // Almacenará la lista de libros
  const [loading, setLoading] = useState(true);   // Indicador de carga
  const [error, setError] = useState(null);       // Para capturar errores

  useEffect(() => {
    // Cambia la URL por la correcta según tu entorno
    const apiUrl = 'http://localhost:10068/wp-json/wp/v2/books';

    fetch(apiUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error('Error al obtener los datos');
        }
        return response.json();
      })
      .then((data) => {
        setBooks(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error('Error en la consulta:', err);
        setError(err.message);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <p className='bg-conic-180'>Cargando libros...</p>;
  }

  if (error) {
    return <p>Error: {error}</p>;
  }

  return (
    <div className="max-w-3xl mx-auto py-[24px] bg-white shadow-lg rounded-lg">
      <h2 className="font-bold text-2xl text-red-500  text-center mb-6">Lista de Libros</h2>
      <ul className="space-y-6">
        {books.map((book) => (
          <li
            key={book.id}
            className="bg-gray-100 p-4 rounded-lg shadow-md cursor-pointer"
          >
            <h3 className="text-lg font-semibold text-gray-800 mb-2">{book.title.rendered}</h3>
            <div className="text-gray-600 leading-relaxed" dangerouslySetInnerHTML={{ __html: book.content.rendered }} />
          </li>
        ))}
      </ul>
    </div>
  );  
};

export default BooksList;
