CREATE TABLE Clients (
    client_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    contact_name VARCHAR(255),
    contact_email VARCHAR(255),
    contact_phone VARCHAR(20),
    address VARCHAR(255),
    industry VARCHAR(100)
);

CREATE TABLE Departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    head_of_department INT,

);

CREATE TABLE Employees (
    employee_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(20),
    role VARCHAR(100),
    salary DECIMAL(10, 2),
    department INT

);

CREATE TABLE Projects (
    project_id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(50) CHECK (status IN ('In Progress', 'Completed', 'Pending')),
    start_date DATE,
    end_date DATE,
    budget DECIMAL(15, 2)

);

CREATE TABLE Tasks (
    task_id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    assigned_to INT,
    status VARCHAR(50) CHECK (status IN ('Pending', 'In Progress', 'Completed')),
    start_date DATE,
    end_date DATE,
    priority VARCHAR(50) CHECK (priority IN ('High', 'Medium', 'Low'))

);

CREATE TABLE TimeLogs (
    log_id INT PRIMARY KEY AUTO_INCREMENT,
    employee_id INT NOT NULL,
    task_id INT NOT NULL,
    log_date DATE NOT NULL,
    hours DECIMAL(5, 2) CHECK (hours > 0),
    description TEXT
);

CREATE TABLE Invoices (
    invoice_id INT PRIMARY KEY AUTO_INCREMENT,
    project_id INT NOT NULL,
    amount DECIMAL(15, 2) CHECK (amount >= 0),
    issued_date DATE,
    due_date DATE,
    status VARCHAR(50) CHECK (status IN ('Paid', 'Unpaid', 'Overdue'))
);


-- Insert data into Clients
INSERT INTO Clients (name, contact_name, contact_email, contact_phone, address, industry)
VALUES 
('Acme Corporation', 'John Doe', 'john.doe@acmecorp.com', '123-456-7890', '123 Main St, Cityville', 'Technology'),
('Bright Solutions', 'Jane Smith', 'jane.smith@brightsolutions.com', '234-567-8901', '456 Elm St, Townsville', 'Consulting'),
('Creative Minds', 'Emily White', 'emily.white@creativeminds.com', '345-678-9012', '789 Oak St, Villageton', 'Marketing'),
('Digital Innovators', 'Michael Brown', 'michael.brown@diginnovators.com', '456-789-0123', '321 Pine St, Cityville', 'Finance'),
('Efficient Tech', 'Sarah Black', 'sarah.black@efficienttech.com', '567-890-1234', '654 Maple St, Townsville', 'Manufacturing');

-- Insert data into Departments
INSERT INTO Departments (name, head_of_department)
VALUES 
('Software Development', NULL),
('Marketing', NULL),
('Sales', NULL),
('Human Resources', NULL),
('Finance', NULL);

-- Insert data into Employees
INSERT INTO Employees (first_name, last_name, email, phone, role, salary, department)
VALUES 
('Alice', 'Johnson', 'alice.johnson@company.com', '123-123-1234', 'Developer', 60000.00, 1),
('Bob', 'Smith', 'bob.smith@company.com', '234-234-2345', 'Project Manager', 75000.00, 1),
('Charlie', 'Brown', 'charlie.brown@company.com', '345-345-3456', 'Marketing Specialist', 55000.00, 2),
('Diana', 'Green', 'diana.green@company.com', '456-456-4567', 'Sales Manager', 70000.00, 3),
('Evan', 'Lee', 'evan.lee@company.com', '567-567-5678', 'HR Specialist', 50000.00, 4);

-- Insert data into Projects
INSERT INTO Projects (client_id, name, description, status, start_date, end_date, budget)
VALUES 
(1, 'Website Redesign', 'Redesign the corporate website for Acme Corp.', 'In Progress', '2024-01-01', '2024-06-01', 20000.00),
(2, 'Marketing Campaign', 'Develop a new campaign for Bright Solutions', 'Completed', '2023-09-01', '2023-12-01', 15000.00),
(3, 'Product Launch', 'Assist Creative Minds with launching a new product', 'Pending', '2024-02-01', '2024-07-01', 30000.00),
(4, 'Financial Software', 'Create a custom software solution for Digital Innovators', 'In Progress', '2024-03-01', '2024-08-01', 40000.00),
(5, 'Manufacturing Optimization', 'Improve the process for Efficient Tech', 'Pending', '2024-04-01', '2024-09-01', 25000.00);

-- Insert data into Tasks
INSERT INTO Tasks (project_id, name, assigned_to, status, start_date, end_date, priority)
VALUES 
(1, 'Design Mockups', 1, 'In Progress', '2024-01-01', '2024-02-15', 'High'),
(1, 'Front-End Development', 2, 'Pending', '2024-02-16', '2024-04-01', 'High'),
(2, 'Social Media Ads', 3, 'Completed', '2023-09-01', '2023-10-15', 'Medium'),
(3, 'Product Design', 1, 'Pending', '2024-02-01', '2024-03-01', 'High'),
(4, 'Financial Data Integration', 2, 'In Progress', '2024-03-01', '2024-05-01', 'High');

-- Insert data into TimeLogs
INSERT INTO TimeLogs (employee_id, task_id, log_date, hours, description)
VALUES 
(1, 1, '2024-01-02', 5.5, 'Worked on initial mockups'),
(2, 4, '2024-03-01', 6.0, 'Set up data integration'),
(3, 3, '2023-09-05', 4.0, 'Created social media strategy'),
(1, 1, '2024-01-03', 4.0, 'Refined mockup design'),
(2, 5, '2024-03-02', 5.0, 'Data testing');

-- Insert data into Invoices
INSERT INTO Invoices (project_id, amount, issued_date, due_date, status)
VALUES 
(1, 10000.00, '2024-01-15', '2024-02-15', 'Paid'),
(2, 15000.00, '2023-09-10', '2023-10-10', 'Paid'),
(3, 8000.00, '2024-02-01', '2024-03-01', 'Unpaid'),
(4, 20000.00, '2024-03-10', '2024-04-10', 'Unpaid'),
(5, 12500.00, '2024-04-15', '2024-05-15', 'Unpaid');
