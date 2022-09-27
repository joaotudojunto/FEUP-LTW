# LTW-Proj-2022

## FEUP - L.EIC - University of Porto

**Project Authors:**

>Alberto Serra<br>
>Miguel Tavares<br>
>JoÃ£o Duarte


## Database

**UML**

![img](database/uml_image.png)

**Relation Model**

Restaurant(<ins>idRestaurant</ins>, name, classification, address, description, serviceHours, maxPrice, minPrice, username->User, idMenu->Menu)<br>
User(<ins>username</ins>, userType, password, name, phoneNumber, address, email, description, registrationDate)<br>
Category(<ins>idCategory</ins>, name)<br>
Dish(<ins>idDish</ins>, name, description, price, idCategory->Category)<br>
Menu(<ins>idMenu</ins>)<br>
Vehicle(<ins>idVehicle</ins>, vehicle, licensePlate, username->User)<br>
Review(<ins>idReview</ins>, postedTime, text, classification, username->User, idRestaurant->Restaurant)<br>
Notification(<ins>idNotification</ins>, type, content, check, username->User)<br>
Order(<ins>idOrder</ins>, state, content, requestDate, username->User, idRestaurant->Restaurant)<br>
OrderMessage(<ins>idOrderMessage</ins>, text, messageDate, idOrder->Order)<br>
DishHistory(<ins>idDishHistory</ins>, date, priceHistory, idDish->Dish)<br>
RestaurantCategory(<ins>idRestaurant</ins>->Restaurant,<ins>idCategory</ins>->Category)<br>
MenuDish(<ins>idMenu</ins>->Menu, <ins>idDish</ins>->Dish)<br>
FavoriteRestaurant(<ins>idRestaurant</ins>->Restaurant, <ins>idUser</ins>->User)<br>
FavoriteDish(<ins>idDish</ins>->Dish, <ins>idUser</ins>->User)<br>


## Mockups

### Example ...

<i>All the examples are included in the mockup directory.</i>

**Main page layout**

<img src="Mockups/MainPage.png" width="400" height="400"/>

## Final Front End Design

### Some examples ...

<i>All the images are included in the mockup directory.</i>

**Non Logged Header**

<img src="DesignImages/NonLogHeader.png" width="700" height="250"/>

**Logged In Header**

<img src="DesignImages/LoginHeader.png" width="700" height="250"/>

**Main Page**

<img src="DesignImages/Main.png" width="700" height="250"/>

**Forms General Design**

<img src="DesignImages/FormsModel.png" width="500" height="400"/>

**Restaurant Page**

<img src="DesignImages/Restaurant.png" width="500" height="400"/>


# Finished and Functional Features

>All features that are fully functional and successfully completed.
- [x] Register
- [x] Login/Logout
- [x] Edit Profile
- [x] Mark Restaurant as Favourite
- [x] List favorite restaurants on user's profile
- [x] Search Restaurants by name
- [x] Search Restaurants by location
- [x] Search Restaurants by foodstyle
- [x] Search Restaurants by rating
- [x] List Reviews by restaurants
- [x] List all the restaurants
- [x] List dishes by restaurant's menu
- [x] List restaurants information (location and working hours)


## Credentials

outlet@gmail.com / abcd77HHeg  `owner`</br>
quimrapina@gmail.com / abcdei `driver`</br>
filipe@gmail.com / abc92KSK `customer`</br>


# Unfinished Started Features

>All features that already have some kind of work associated with them. 
>Features that have actions and methods in classes that are not yet functional 
> but present in the project.

- [ ] Change Order State
- [ ] Order Dishes
- [ ] List My Orders
- [ ] Customer Can Leave a Review
- [ ] Mark Dish as Favourite
- [ ] Restaurant Owner Can Answer to Review
- [ ] Add Restaurant
- [ ] Edit Restaurant
- [ ] Add Dishes
- [ ] List Customer Orders
- [ ] Remove favorite restaurants from user
- [ ] Add vehicle to driver 
- [ ] Edit driver's vehicle


# Security 

>Parts of the code that were designed to strengthen the site's security level.

- Password edits has an hash verification in the User class.
- Usage of htmlspecialchars function in Sign Up User.
- Usage of filter_var with FILTER_SANITIZE on setting variables.
- Exceptions were used in some functions in the project as well as try and catches.
- PDO verification variables in binding variables in functions.
