import { useState, useEffect } from "react";
import { Link } from "react-router-dom";

const BooksList = () => {
  const [books, setBooks] = useState([]); // Almacena la lista de libros
  const [loading, setLoading] = useState(true); // Indicador de carga
  const [error, setError] = useState(null); // Para capturar errores

  useEffect(() => {
    const apiUrl = "http://localhost:10068/wp-json/wp/v2/books";

    fetch(apiUrl)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error al obtener los datos");
        }
        return response.json();
      })
      .then((data) => {
        setBooks(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Error en la consulta:", err);
        setError(err.message);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <p className="text-center text-indigo-600 font-semibold py-10">Cargando libros...</p>;
  }

  if (error) {
    return <p className="text-center text-red-600 font-semibold py-10">Error: {error}</p>;
  }

  return (
    <div className="py-3.5">
      {/* Imagen de Encabezado */}
      <div className="relative w-full h-64">
        <img
          src="https://images.unsplash.com/photo-1512820790803-83ca734da794"
          alt="Libros en una biblioteca"
          className="w-full h-64 object-cover opacity-70 hover:opacity-100 transition-opacity duration-300"
        />
        <h2 className="absolute inset-0 flex items-center justify-center text-white text-4xl font-extrabold bg-black/40">
          📚 Book List
        </h2>
      </div>
      <div className="mx-auto py-10 px-4 min-h-screen">
        <ul className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          {books.map((book) => (
            <li
              key={book.id}
              className="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-2 border border-gray-200"
            >
              <Link to={`/book/${book.id}`} className="block">
                {/* Título */}
                <h3 className="text-xl font-bold text-gray-900 mb-3">
                  {book.title.rendered}
                </h3>

                {/* Resumen ACF (si existe) */}
                {book.acf?.summary && (
                  <p className="text-gray-700 text-sm italic line-clamp-2">
                    {book.acf.summary}
                  </p>
                )}

                {/* Contenido HTML Seguro */}
                <div
                  className="text-gray-700 leading-relaxed text-sm mt-2 line-clamp-3"
                  dangerouslySetInnerHTML={{ __html: book.content.rendered }}
                />
              </Link>
            </li>
          ))}
        </ul>
      </div>
      <div>
        Fsvorite book
      </div>
    </div>
  );
};

export default BooksList;
