# Santafe Checker

Checkea si hay nuevos concursos en el sitio de la provincia.

## USO

Clonamos el proyecto:

```
git clone https://github.com/Germanaz0/santafe-checker.git
```

Instalamos vendors (necesitamos tener composer en nuestro equipo):

```
composer install
```

Por último agregamos un cronjob, el sistema nos enviará una notificación muy bonita si aparecen cambios en el sitio de la provincia.

```
* * * * * {PATH_PROYECTO}/santafe-checker/santafe schedule:run >> /dev/null 2>&1
````


### SCREENSHOTS:

<p align="center">
    <img title="Santa Fe Notification" height="100" src="https://github.com/Germanaz0/santafe-checker/blob/master/app/assets/notification.png" />
</p>

<p align="center">
    <img title="Santa Fe Console" height="100" src="https://github.com/Germanaz0/santafe-checker/blob/master/app/assets/console.png" />
</p>