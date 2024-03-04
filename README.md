# Running the Application
Prerequisites
Before running the application, ensure that you have the following prerequisites installed:

- PHP (>= 7.4)
- Composer
- MySQL or another compatible database system
# Running the Application
To start the Laravel development server, run the following command:
- php artisan serve
# Seeding the Database
- php artisan migrate --seed

# Hotel Booking System API Documentation
### Introduction
The Hotel Booking System API provides endpoints to manage hotel rooms, bookings, customers, and payments. This documentation outlines the functionality and usage of the API.

### Authentication
The API uses token-based authentication. Users must obtain an authentication token to access protected endpoints. Tokens are provided upon successful login.

### Base URL
http://127.0.0.1:8000/api

## Endpoints
#### Rooms
- GET /rooms: Retrieve a list of rooms.
- POST /rooms: Create a new room.
- GET /rooms/{id}: Retrieve details of a specific room.

#### Bookings
- GET /bookings: Retrieve a list of bookings.
- POST /bookings: Create a new booking.

#### Customers
- GET /customers: Retrieve a list of customers.
- POST /customers: Create a new customer.

#### Payments
- POST /payments: Record a payment against a booking.

