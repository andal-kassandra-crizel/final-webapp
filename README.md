CuraDesk: A Web-Based Clinic Management System

The Clinic Management System (CMS) is a web-based platform designed to automate clinic operations and improve service efficiency. It enables patients to book appointments online and administrators to oversee schedules, services, and records. The system minimizes paperwork and manual errors by integrating all functions into a unified digital interface. The main goals of the CMS are to simplify appointment scheduling, improve patient record accuracy and accessibility, and enhance administrative control over services and schedules. The key features are online appointment booking, patient record management and administrative dashboard for managing users,doctors, services, and schedules.

Features Implemented
USER/PATIENT
- Book Appointment - it allows patients to schedule appointments by selecting a service, doctor, and available date.
- Manage Appointment History 
Enables patients to view their past and upcoming appointments.
Can see appointment details and their current status (pending, approved, cancelled, etc.)
- Manage Account - patients can view or edit their personal details

ADMIN
- Manage Patient - Admin can view patient records, contact details, and appointment history.
- Manage Booking Appointments - Admin can view, approve, or cancel patient appointments.
- Manage Services
Admin can add, edit, or remove services offered (e.g., dental cleaning, consultation).
Can assign services to specific doctors or categories.
- View Dashboard
Displays analytics such as total patients, upcoming appointments, most booked services, etc.

Database Structures
 Account
 user_id | firstname | middlename | lastname | email | password | role | 

 appointments
 appointment_id | user_id | firstname | middlename | lastname | email | age | service_id | doctor_id | appointment date | message |

 doctors
 doctor_id | doctor_name | category_id | email | phone | status | 

 services
 service_id | category_id | service_name |

 service_categories
 category_id | category_name | 
