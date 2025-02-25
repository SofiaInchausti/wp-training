import { useParams } from 'react-router-dom';  // Para obtener parámetros de la URL
import { useState, useEffect } from "react";

const BookDetail = () => {
  const { id } = useParams();  // Obtiene el id del libro desde la URL
  const [book, setBook] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const apiUrl = `http://localhost:10068/wp-json/wp/v2/books/${id}`;

    fetch(apiUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error al obtener los detalles del libro");
        }
        return response.json();
      })
      .then((data) => {
        setBook(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Error en la consulta:", err);
        setError(err.message);
        setLoading(false);
      });
  }, [id]);

  if (loading) {
    return <p className="text-center text-lg font-semibold text-gray-700">Cargando detalles del libro...</p>;
  }

  if (error) {
    return <p className="text-center text-red-500 font-semibold">Error: {error}</p>;
  }
  console.log(book,'ppp')

  return (
    <div className="mx-auto py-10 px-4 sm:px-8 lg:px-16 min-h-screen">
    {/* Contenedor del contenido del libro */}
    <div className="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 sm:p-10">
      {/* Título del libro */}
      <h2 className="text-3xl sm:text-4xl font-extrabold text-gray-900 text-center mb-6">
        {book.title.rendered}
      </h2>
  
      {/* Resumen del libro */}
      <p className="text-gray-800 text-lg sm:text-xl font-medium text-center mb-6">
        {book.acf.summary}
      </p>
  
      {/* Contenido del libro */}
      <div
        className="text-gray-700 leading-relaxed text-base sm:text-lg mx-2 sm:mx-4 prose prose-indigo"
        dangerouslySetInnerHTML={{ __html: book.content.rendered }}
      />
    </div>
  </div>
  
  );
};

export default BookDetail;
