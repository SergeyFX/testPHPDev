# testPHPDev
This project is architected with a decoupled frontend and backend structure to ensure scalability and maintainability.

Backend: The core application logic and data management are handled by a powerful backend developed in PHP, leveraging the advanced features and security of the Laravel framework.

Frontend: The user interface is a modern Single-Page Application (SPA) built with the Vue.js framework. The UI is implemented using the comprehensive PrimeVue component library to deliver a rich, responsive, and intuitive user experience.
## Include
- Backend please read backend/README.MD to run
- Frontend  please read frontend/README.MD to run

## Project Architecture
### Project Architecture and Development Environment Overview

This project is architected with a decoupled frontend and backend structure to ensure scalability and maintainability. It is currently configured for a local development environment.

Backend: The core application logic and data management are handled by a powerful backend developed in PHP, leveraging the advanced features of the Laravel framework.

Server Configuration: The backend server runs locally on http://localhost:80.

API Endpoint: The primary API route for the search functionality is accessible at localhost/api/realties/search.

Frontend: The user interface is a modern Single-Page Application (SPA) built with the Vue.js framework. The UI is implemented using the comprehensive PrimeVue component library to deliver a rich, responsive, and intuitive user experience.

Server Configuration: The frontend application is served locally using Vite on http://localhost:5173.

Security and Access Control: Please note that in its current development stage, the project does not implement user authentication or middleware for access control. All API endpoints are publicly accessible within the local network environment.

Testing and Documentation:

Quality Assurance: Formal testing protocols, including unit, feature, or integration tests, have not been implemented in this phase of the project.

API Documentation: The project does not include a public-facing API documentation tool (such as Swagger or OpenAPI) for automated endpoint documentation and exploration. All endpoint details must be communicated directly.
