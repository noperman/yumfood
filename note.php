<?

/**
 * - php artisan make:model VendorMenu -a
 * - php artisan make:model Order -a
 * - php artisan make:model OrderDetail -a
 * 
 * - modification of exceptionHandler (ValidationException, ModelNotFoundException)
 * - modification of VendorController (store, show, update, delete)
 * 
 * - make VendorMenu seeder
 * - make Order seeder
 * - make OrderDetail seeder
 * - make relationship
 * 
 * - provide endpoint of dishes by restaurant with pagination
 *   route = get {{url}}/vendor/{id}/dishes 
 *   note  = default filtered with VendorMenu status = 1
 * 
 * - provide endpoint of order
 *   route = post {{url}}/vendor/dishes/order
 *   body of post must be like this example = 
 *    - menu[0] = 1  // menuid
 *    - menu[1] = 2
 *    - menu[2] = 3
 *    .....
 *    - qty[0] = 1
 *    - qty[1] = 3
 *    .....
 *    - note[0] = Note... 
 *    - note[1] = Note... 
 *    
 * - make list of the order request
 *   route = {{url}}/vendor/dishes/order/{id}/list
 * 
 * - extend {{url}}/vendors to get {{url}}/vendors?tags
 */