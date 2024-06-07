# Joseph Kithome Technical Test Submission

## 1. Single-Quoted vs. Double-Quoted Strings in PHP

PHP supports both single-quoted (`'`) and double-quoted (`"`) strings. Here's a summary of their differences:

- **Single-quoted strings**:
  - Returns the string as it is, without processing special characters or variable interpolation.
  - Limited escape sequences (e.g., `\\` and `\'`).
  - Used when variable interpolation or special escape sequences are not needed.

- **Double-quoted strings**:
  - Supports a wider range of escape sequences (e.g., `\n`, `\t`, `\$`) and variable interpolation.
  - Useful when you need to include variables or special characters within the string.

## 2. Principles of Object-Oriented Programming (OOP) in PHP

Object-Oriented Programming (OOP) in PHP involves creating objects that encapsulate both data and functions. Key principles include:

- **Encapsulation**: Wrapping data and functions into a single unit (class).
- **Inheritance**: Deriving properties and characteristics from parent classes.
- **Polymorphism**: The ability of objects to take on different forms based on the context.
- **Abstraction**: Providing essential information while hiding implementation details.

Example of defining a class and creating objects in PHP:

```php
class Candidate {
  // Properties
  public $first_name;
  public $last_name;
  public $email;
  public $phone;

  // Getter Methods
  // Setter Methods
}

$c = new Candidate();
$c->set_first_name('Joseph');
$c->set_last_name('Kithome');
$c->set_email('josephkithome.jmk@gmail.com');
$c->set_phone('254717064174');
```

## 3. Exception Handling in PHP

Exception handling in PHP allows graceful management of errors. Use try-catch blocks to catch and handle exceptions. Example:

```php
try {
  // Code that may throw exceptions
} catch (Exception $e) {
  // Handle the exception
}
```

## 4. Database Connection in PHP (MySQLi vs. PDO)

Comparison between MySQLi and PDO:
- **MySQLi**: Supports MySQL databases, procedural and object-oriented programming.
- **PDO**: Supports multiple databases, object-oriented programming, and easier database switching.

Example using PDO:

```php
try {
  $conn = new PDO("mysql:host=localhost;dbname=your_db", "username", "password");
  // Execute queries
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
```

## 5. Protecting PHP Applications from Security Vulnerabilities

Prevent SQL injection by using prepared statements with parameterized queries. Prevent XSS by sanitizing user inputs and escaping outputs.

## 6. Cloud Service Providers (AWS, Azure, Google Cloud)

Comparison:
- **AWS**: Extensive services, global reach, strong community.
- **Azure**: Integration with Microsoft products, hybrid cloud.
- **Google Cloud**: Strong in data analytics, competitive pricing.

For PHP application deployment, AWS is preferred due to its extensive services and global infrastructure.

## 7. Infrastructure as Code (IaC) in AWS

IaC automates provisioning and management of infrastructure using code. Example using AWS CloudFormation or Terraform to define infrastructure components.

## 8. Sum of Even Numbers in PHP

Write a PHP function that takes an array of integers and returns the sum of all even numbers in the array.

## 9. Count Words in a Text File in PHP

Create a PHP script to read a text file, count the number of words, and display the result.

## 10. Making GET Requests to a REST API in PHP

Use PHP to make a GET request to a REST API, parse the JSON response, and display specific information (e.g., user's name and email).

## 11. Designing Auto-Scaling Setup in AWS

Use Auto Scaling Groups in AWS to handle fluctuating traffic. Configure scaling policies based on metrics like CPU utilization.

## Advanced Questions

12. Asynchronous Processing with Message Queue System (RabbitMQ or Redis)

Set up RabbitMQ, create producer and consumer scripts to handle tasks asynchronously.

13. Serialize and Compress Data in PHP

Serialize a large data structure, compress it, save to a file, and then unserialize and decompress the data.

14. OAuth 2.0 Authentication with REST API in PHP

Implement OAuth 2.0 authorization code flow to obtain an access token and make authenticated requests to a REST API.

15. Connect to MS SQL Server Database and Perform Complex Queries in PHP

Retrieve data from multiple tables, perform complex SQL queries, and return results as JSON.

---

This README provides an overview of Joseph Kithome's technical test submission, covering various topics in PHP development and cloud computing. Each section contains explanations, code examples, and links to the corresponding GitHub repository for further reference.
