# Final Capstone Project & My Plugin 🚀

This project follows a practice guide for developing a WordPress theme and plugin using React, Tailwind CSS, and Advanced Custom Fields (ACF). The final theme, named Final Capstone Project, and the plugin, named My Plugin, work together to provide dynamic book listings and a customizable favorite book feature.

##Installation & Setup

To use this project, both the theme and plugin must be installed in a fresh WordPress setup. You can set up a local WordPress environment using Local or any other local development tool.

## Steps:

Download and install the theme and plugin:

Place the final-capstone-project folder inside wp-content/themes/

Place the my-plugin folder inside wp-content/plugins/

## Activate the theme and plugin:

Go to the WordPress Admin Panel → Appearance → Themes and activate Final Capstone Project.

Go to the WordPress Admin Panel → Plugins and activate My Plugin.

Start development mode or build for production:

Development mode: npm run dev/start

Production mode: npm run build

## Features

Final Capstone Project (Theme)

Displays a list of books using React.

Clicking on a book redirects to its details page.

Shows the user’s favorite book on the home page.

## My Plugin

Allows users to set their favorite book from the WordPress admin panel.

The theme fetches the favorite book title via a GET request to the WordPress REST API.

## Additional Notes

Other theme folders in this repository are exercises suggested by the practice guide.

The project follows best practices with ESLint and Prettier for code consistency.

## Technologies Used

React & ReactDOM

Tailwind CSS

ACF (Advanced Custom Fields)

ESLint & Prettier
