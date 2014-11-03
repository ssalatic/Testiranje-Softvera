Testiranje-Softvera
===================

Poslovni sistem za plesnu skolu, namenjen kao projekat iz Testiranja Softvera.


## UX notes

* Slike se nalaze u **UX/Images** folderu.
* Slike su organizovane u podfolderima po tipu usera.
* Svaka stranica za obicnog usera ima mobile verziju.
* Stranice za admina nemaju mobilnu verziju, vec iskljucivo desktop.
* **Annotated** verzije fajlova sluze za objasnjavanje funkcionalnosti i nisu graficki update-ove na najnoviju verziju. Ne koristiti ih kao guideline, vec samo ako vam nesto nije jasno procitajte objasnjenje tamo.
* Dizajn ne mora da bude identican, ovo je samo organizacija, i cak u nekim stvarima nisu postavljeni odgovarajuci tipovi (kao sto je listbox).
* Neke stvari ce se promeniti kako dodamo polja u bazu, ali je to uglavnom ubacivanje novih stvari, tako da slobodno cepajte po ovome. Samo proveravajte sa vremena na vreme sta je update-ovano od fajlova.


> May the force be with you

##user_type:
* 0 - admin
* 1 - trener
* 10 - user

##IZMENE: (za testere)
* DIR app/contollers
* DIR app/models
* DIR app/views
* app/routes.php
* app/fiters.php
* app/start/global.php <- Ovde stoje error handleri za 404 i sl. Zakomentarisite za testiranje.
