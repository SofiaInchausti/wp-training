import { useState, useEffect } from "react";
import { Link } from "react-router-dom";

export const BooksList = () => {
  const [books, setBooks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [favoriteBook, setFavoriteBook] = useState(null);

  useEffect(() => {
    // Fetch the user's favorite book from the API
    fetch("/wp-json/my-custom-plugin/v1/favorite-book")
      .then((res) => {
        if (!res.ok) {
          throw new Error("Error al obtener los datos");
        }
        return res.json();
      })
      .then((data) => {
        setFavoriteBook(data.favorite_book);
      })
      .catch((err) => {
        console.error("Error en la consulta:", err);
        setError(err.message);
        setLoading(false);
      });

    // Fetch the list of books from the API
    fetch("/wp-json/wp/v2/books")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error fetching data");
        }
        return response.json();
      })
      .then((data) => {
        setBooks(data);
        setLoading(false);
      })
      .catch((err) => {
        console.error("Fetch error:", err);
        setError(err.message);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <p className="text-center text-indigo-600 font-semibold py-10">Loading books...</p>;
  }

  if (error) {
    return <p className="text-center text-red-600 font-semibold py-10">Error: {error}</p>;
  }

  return (
    <div className="py-3.5">
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
        <ul className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 pb-12">
          {books.map((book) => (
            <Link key={book.id} to={`/book/${book.id}`} className="block">
              <li className="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-2 border border-gray-200">
                <h3 className="text-xl font-bold text-gray-900 mb-3">{book.title.rendered}</h3>
                {book.acf?.summary && (
                  <p className="text-gray-700 text-sm italic line-clamp-2">{book.acf.summary}</p>
                )}
                <div
                  className="text-gray-700 leading-relaxed text-sm mt-2 line-clamp-3"
                  dangerouslySetInnerHTML={{ __html: book.content.rendered }}
                />
              </li>
            </Link>
          ))}
        </ul>
        {/* Display the user's favorite book */}
        <div className="max-w-sm mx-auto bg-white border border-gray-200 rounded-lg shadow-lg p-4">
          <h2 className="text-xl font-semibold text-center text-gray-800">
            <span className="text-yellow-500 mr-2">★</span> Your favorite book: {favoriteBook}
          </h2>
        </div>
      </div>
    </div>
  );
};
