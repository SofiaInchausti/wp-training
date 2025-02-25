import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import BooksList from './BookList'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import BookDetail from './BookDetail'


createRoot(document.getElementById('root')).render(
  <StrictMode>
    <Router> {/* Envuelve toda tu aplicación con Router */}
      <Routes> {/* Define las rutas dentro de Routes */}
        <Route path="/" element={<BooksList />} /> {/* Ruta principal */}
        <Route path="/book/:id" element={<BookDetail />} /> {/* Ruta para la página About */}
      </Routes>
    </Router>
  </StrictMode>,
)
