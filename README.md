# prueba-bring 
Para realizar la prueba:
	- Para realizar la prueba se ha usado WampServer64
	- Me descargue el certificado cacert.pem de la pagina: https://curl.se/ca/cacert.pem e hice las configuraciones necesarias para poder llamar a la Api:
	GET https://tinyurl.com/api-create.php?url=http://www.example.com
	- Para la solución de la prueba:
		* Me cree el directorio app/Helpers y dentro de este directorio cree dos clases: ApiService.php para obtener la respuesta de la Api externa y CheckAuth.php para validar el token.
		* Cree los Providers: ApiServiceServiceProvider.php y CheckAuthServiceProvider.php que hacen uso de las clases: ApiService.php y CheckAuth.php respectivamente.
		* Se ha creado el Middleware: ApiAuthMiddleware.php que hace uso de la clase: CheckAuth.php para que sólo pueda obtener la Url si el token es correcto (realizar la validación previa a ejecutar lo del controlador).
		* Se ha creado el controlador:  PruebaController.php y la ruta:
		Route::post('/api/v1/short-urls', 'PruebaController@shortUrl')->name('short-urls');
		* Se han realizado los test:  ApiServiceTest.php, CheckAuthTest.php y PruebaControllerTest.php
		* También se han realizado pruebas en Postman
		Ejemplo de llamada en postman:

		Post:  http://localhost/prueba-bring/public/api/v1/short-urls
		Headers: key: Authorization value: {}[]
		Body: fom-data key: url: http://www.example.com