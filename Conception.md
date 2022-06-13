## for the presentation  
<mark>use the chart of incomes and the market cap of large gym management systems, with market needs and growth for this business module.</mark>  
# What is the problem  
gym managers need a new way to track their clients rather than paper of poor-features applications  
# Purpose of the system  
gym system to help gym owners track their clients  
  
# How will the solution work  
provide some functionality to track and help owners as well as their clients, and the subscriptions, attendance, and income, notifications clients subscriptions end  
  
## upcoming features or add-ons  
- exercises for members  
- invoices(reports)  
- Fingerprint  
- members application  
- CRM  
- online appointment booking  
- payments  
- discounts and motivation offers for loyal members  
- make is SAAS  
- dark theme  
- landing page  
- dept and other financial problems  
- cancel subscription  
- payments history of all members  
- member profile  
- member attendances  
- advance search for members, attendance,...  
- thinking of developing a simple QR-code scanner using Arduino or another board  
- display attendance in the calendar for each member  
- invite members
# telling a simple story  
first, we need a simple and professional system installation process we need to know what is the database name, URL, password, and maybe the type in some cases, we need to create an account for the admin with full name, email, and password also we need some information about the subscriptions so next step will be set up the system by choice a (name logo(skip-able), working times(skip-able)) -> subscriptions(skip-able) -> waiting for setup...  
next the admins can see subscriptions and manage them by (name icon, number of possible attendance, price) add staff(full name, email, password(generate password),number,address ), manage members (first name,last name,gender, number, email,password,subscription_type, weight, birthday, password(auto-generate),avatar)  
attendance of members each time will change when a member logs his attendance and show rest attendance, adding attendance for a member by searching for his name from a modal or by older attendance, or from notifications,  
admin can modify gym details  
notify staff when a member's subscription is about to end(settings for those notifications and when will be sent), also notify the member by his email that his subscription is about to end  
  
## problem  
gym owners working with paper or cards is not a good practice paper may be wast or the member may forget his card  
  
## how the system will work  
the trainer will come to the gym if he doesn't have an account the staff working in the gym will create his account and set his subscription and a new attendance will be created automatically   if not and the member has an account here will need to create new attendance for him will a have to handle all possibilities in that case first by the interface from the platform this and I make sure it easy to use, second staff will have access to manage user access QR-code so he can print in on a paper(later I will make a customized  interface for that QR-code to be good at printing or having a custom QR-code theme) then every time the member comes with his card the staff will scan it and the system will check it and display the member info to verify, thirty is the will offer a simple application for the first MVP so they can log in and declare that they went to the gym (not for Moroccan like me ;-) )  
also offer the possibility to the member for scanning a QR-code display in the company door or in the system by his device then a new attendance will be generated for that specific member  
N.B: the trainer can see the staff when he is going to add new attendance and will see how much attendance still for that trainer, also the system will check before adding new attendance, then let's say that the member subscribe to the starter plan and is about to finish the trainer and the staff will receive a notification  from the system telling that the subscription(memberships) is about to finish with a button to create a new subscription for the staff  
later may I will offer ad-dons to the system to use a qr-code scanner device to scan QR-code from member phone  
  
the admin can change his password & email from the restaurant page  
  
# Database description  
#### gym_info  
###### attributes  
- name  
- slogan  
- logo  
- description  
- #gym_contact_info  
###### description  
this table will have all info about the system so the admin can edit does info also that info will be displayed on the landing page as well as on the dashboard like name contact...  
#### Admin  
##### attributes  
- full name  
- email  
- password  
- phone number  
##### description  
this table will contain the admin information and will be created in the setup of the system  
  
#### Memberships  
##### attributes  
- title  
- price  
- icon  
- number_of_attendances  
##### description  
this table will give admins possibilities or creating deference subscription that his gym class offer for the members with price, and possible attendance  
#### staff  
##### attributes  
- full name  
- email  
- password(generate a password for the admin)  
- number  
- address  
##### description  
this table will have info about the staff working to manage the gym and the admin who will create does accounts with the ability to generate passwords or choice one and the ability to manage and edit does info  
#### members  
##### attributes  
- member_id (Mxxxxx) this id will be displayed in the card and the profile for search to find the member in the system  
- UUID (will be used to generate the QR-code)  
- first name  
- last name  
- gender  
-  number  
- username  
- email  
- #membership  
-  weight  
- birthday  
- password(auto-generate)  
- avatar  
##### description  
table for the members with all needed data and info for each one and to make is easy for staff to manage the gym and track attendance, and they can edit his info, and manage the accounts of members  
#### attendance  
##### attributes  
- #member_id  
- attended_at  
##### description  
this table will record the new attend of members  
#### subscription  
##### description  
this table will record the new subscription and with the start date and when will the subscription expire the member how paid this subscription and the type of that membership  
##### attributes  
- #member_id  
- #membership_id  
- start_at  
- expire_at

## needs
- members info not enough (emergency contact)
- member check id
