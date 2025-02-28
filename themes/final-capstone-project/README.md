# Final Capstone Project (WordPress Theme) 🔸

A custom WordPress theme developed using React, Tailwind CSS, and Advanced Custom Fields (ACF). This theme dynamically displays a list of books and allows users to view details of selected books. Additionally, it retrieves and displays the user’s favorite book from the WordPress database.

## Installation

1. Download and place the `final-capstone-project` folder inside `wp-content/themes/`.
2. Activate the theme from the WordPress admin panel under **Appearance > Themes**.
3. Ensure that **My Plugin** is installed and activated to use the favorite book feature.

## Features

- Displays a list of books using React.
- Clicking on a book redirects to its details page.
- Shows the user’s favorite book on the home page.
- Retrieves the favorite book title via a GET request to the WordPress REST API.

## Development & Production

The theme includes development and production instances:

- **Development Mode:** `npm run dev`
- **Production Mode:** `npm run start`
- **Build for Production:** `npm run build`

## Technologies Used

- **React** & **ReactDOM**
- **Tailwind CSS**
- **ACF (Advanced Custom Fields)**
- **WordPress REST API**
- **ESLint & Prettier**

