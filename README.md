# Simple Blog Application

This is a simple blog application built with a modern tech stack. Follow the instructions below to get started with setting up and running the application on your local machine.

## Prerequisites

Before getting started, make sure you have the following installed:

- [Docker](https://docs.docker.com/engine/install/)
- [DDEV](https://ddev.readthedocs.io/en/stable/#installation)

## Getting Started

1. **Clone the Repository**

   Clone this repository to your computer by running the following command:

   ```bash
   git clone git@github.com:vaske454/pz-simpleblog.git
   ```
2. **Navigate to the Project Directory**

    Change to the project's root directory:
    ```bash
    cd pz-simpleblog
    ```
3. Start the DDEV Environment

   Initiate the project by running:
    ```bash
    ddev start
    ```
   During the startup process, ddev start will run the following commands to set up your environment:
     - ddev mysql < create_tables.sql
     - ddev composer install
     - ddev npm install
     - npx webpack --mode production

   The create_tables.sql file contains SQL queries for creating the necessary tables in the database.

## Development Notes

### JavaScript and CSS Changes

Whenever you make changes to JavaScript or CSS files, you need to recompile them by running:
```bash
npx webpack --mode production
```

This ensures that your changes are reflected in the production build of the application.