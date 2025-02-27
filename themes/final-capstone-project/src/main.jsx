import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import "./index.css";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { BooksList } from "./BookList";
import { BookDetail } from "./BookDetail";

createRoot(document.getElementById("root")).render(
  <StrictMode>
    <Router>
      <Routes>
        <Route path="/" element={<BooksList />} />
        <Route path="/book/:id" element={<BookDetail />} />
      </Routes>
    </Router>
  </StrictMode>
);
