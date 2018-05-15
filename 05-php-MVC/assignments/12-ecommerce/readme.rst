# LAMP Login and Registration

Register and log users in.

Registration Validations:
+ All registration fields required.
+ All registration fields trimmed.
+ First and Lastname must be at least 2 characters.
+ Password and Confirmation must match. (matches)
+ Email address must be unique (is_unique)

Login Validations:
+ Email address must exist.
+ Password must match hash on file.

Notes:
+ Passwords are encrypted during registration with a salt and decrypted by a similar manner upon login.
+ XSS filtering occurs in controller before sending data to Model, and CSRF protection is enabled on all forms by default. 
+ Escaping strings is done using the query method in CodeIgniter (using ?,?,?) automatically escapes strings.


# To Do:

+ Let user delete their own account. (a few things groomed for this feature)