# Use Node.js as the base image
FROM node:18 as build-stage

# Set the working directory inside the container
WORKDIR /app

# Copy package files and install dependencies
COPY package*.json ./
RUN npm install

# Copy the entire project into the container
COPY . .

# Build the application with Vite
RUN npm run build

# Use Nginx for serving the application
FROM nginx:1.23.1-alpine as production-stage

# Copy the built Vite output to Nginx's HTML directory
COPY --from=build-stage /app/public/build /usr/share/nginx/html

# Expose port 80 to the outside world
EXPOSE 80

# Start Nginx server
CMD ["nginx", "-g", "daemon off;"]
