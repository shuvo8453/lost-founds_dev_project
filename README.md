### Steps:

3. **Install Dependencies:**

   Run the following command to install the project dependencies using Composer:

   ```bash
   composer install
   ```

4. **Copy Environment File:**

   Laravel uses an `.env` file for configuration. Copy the example file:

   ```bash
   cp .env.example .env
   ```

   Edit the `.env` file to set up your database configuration, app key, and other settings.

5. **Generate Application Key:**

   Run the following command to generate an application key:

   ```bash
   php artisan key:generate
   ```
5. **Generate Application Key:**

   Run the following command to generate an application key:

   ```bash
   php artisan storage:link
   ```

6. **Database Migration:**

   Migrate the database using the following command:

   ```bash
   php artisan migrate
   ```

7. **Install Node module:**

   Install node module using the following command:

   ```bash
   npm install
   ```
8. **Run Npm:**

   Run npm using the following command:

   ```bash
   npm run dev
   ```

   or 

   ```bash
   npm run build
   ```

9. **Start the Development Server:**

   Launch the Laravel development server:

   ```bash
   php artisan serve
   ```

   By default, the server will be accessible at [http://localhost:8000](http://localhost:8000).

10. **Access the Application:**

   Open your web browser and navigate to [http://localhost:8000](http://localhost:8000) to see your Laravel application.

