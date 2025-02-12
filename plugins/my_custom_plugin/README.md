# My Custom Plugin

A simple WordPress plugin that adds an option to the database upon activation.

## Installation

1. Upload the plugin to `wp-content/plugins/`.
2. Activate it from the WordPress admin panel.

## Features

- Adds `my_custom_plugin_option` to the database when activated.
- Includes a settings page to allow users to store and manage custom options (e.g., "Favorite Book").

## Settings Page

This plugin provides a simple settings page where users can update the value for their "Favorite Book".

### Accessing the Settings Page

Once the plugin is activated, a new menu item titled **"My Plugin"** will appear in the WordPress admin sidebar. To access the settings page:

1. Go to the WordPress admin panel.
2. Navigate to **My Plugin** > **My Plugin Settings**.

### Available Setting

- **Favorite Book**: A text field to input and save a favorite book name. The saved value is stored in the WordPress options table.

### How It Works

1. **Plugin Activation**:
   - When the plugin is activated, the `my_custom_plugin_option` is added to the WordPress database using the `add_option()` function.
   
2. **Settings Page**:
   - The settings page is added to the WordPress admin using the `add_menu_page()` function. It contains a form for saving custom settings.
   
3. **Favorite Book Setting**:
   - The plugin registers the **Favorite Book** field through the WordPress Settings API.
   - The value entered in the **Favorite Book** field is saved to the WordPress database and can be retrieved using `get_option()`.

4. **Retrieving the Value**:
   - You can retrieve the saved **Favorite Book** value with the following PHP code:
     ```php
     $favorite_book = get_option('my_plugin_favorite_book');
     echo 'The favorite book is: ' . esc_html($favorite_book);
     ```