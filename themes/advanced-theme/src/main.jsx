import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'

import BooksList from './BookList.jsx'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <BooksList />
  </StrictMode>,
)
