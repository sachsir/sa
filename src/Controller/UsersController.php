<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function initialize(): void
    {
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
        $this->Model = $this->loadModel('Cars');
        $this->Model = $this->loadModel('Ratings');
        $this->Model = $this->loadModel('Brands');
        if ($this->Authentication->getIdentity()) {
            $auth = true;
        } else {
            $auth = false;
        }
        $this->set(compact('auth'));
    }

    public function usersview()
    {
        $user = $this->Authentication->getIdentity();
        if ($user->role == 0) {
            $users = $this->paginate($this->Users->find('all')->where(['role' => 1]));

            $this->set(compact('users'));
        } else {
            return $this->redirect(['action' => 'home']);
        }
    }

    public function ratingview()
    {
        $key = $this->request->getQuery('key');
        if ($key) {
            $query = $this->Cars->find('all')
                ->where(['Or' => ['company like' => '%' . $key . '%', 'brand like' => '%' . $key . '%', 'model like' => '%' . $key . '%', 'make like' => '%' . $key . '%', 'color like' => '%' . $key . '%']]);
        } else {
            $query = $this->Cars;
        }
        
        $this->paginate = [
            'contain' => ['Ratings'],
            'order' => ['id' => 'desc'],
        ];
        // $cars = $this->paginate($this->Cars);


        $cars = $this->paginate($query);
        $this->set(compact('cars'));
    }

    public function userdelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'usersview']);
    }

    public function index()
    {
        $user = $this->Authentication->getIdentity();
        $users = $this->paginate($this->Users->find('all')->where(['id' => $user->id]));
        $this->set(compact('users'));
        if ($user->role == 0) {
        $key = $this->request->getQuery('key');
        if ($key) {
            $query = $this->Cars->find('all')
                ->where(['Or' => ['company like' => '%' . $key . '%', 'brand like' => '%' . $key . '%', 'model like' => '%' . $key . '%', 'make like' => '%' . $key . '%', 'color like' => '%' . $key . '%']]);
        } else {
            $query = $this->Cars;
        }
        
        $this->paginate = [
            'contain' => ['Ratings'],
            'order' => ['id' => 'desc'],
        ];
        // $cars = $this->paginate($this->Cars);


        $cars = $this->paginate($query);
        $this->set(compact('cars','users'));
    } else {
        return $this->redirect(['action' => 'home']);
    }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        if ($this->Authentication->getIdentity()) {
            $user = $this->Authentication->getIdentity();
            $role = $user->role;
            $user_id = $user->id;
            $name = $user->name;
        } else {
            $role = 1;
        }
        $car = $this->Cars->get($id, [
            'contain' => ['Ratings'],
        ]);

        $ratings = $this->Ratings->find('all')->where(['car_id' => $id])->order(['id' => 'DESC'])->all();

        $rating = $this->Ratings->newEmptyEntity();
        if ($this->request->is('post')) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            $rating['user_id'] = $user_id;
            $rating['car_id'] = $id;
            $rating['user_name'] = $name;
            if ($this->Ratings->save($rating)) {

                return $this->redirect(['action' => 'view', $id]);
            }
        }
        // $this->set(compact('rating'));
        // die($role);
        $this->set(compact('car', 'role', 'rating', 'ratings'));
    }

    //status active inactive functionality
    public function userStatus($id = null, $active)
    {
        $this->request->allowMethod(['post']);
        $car = $this->Cars->get($id);
        if ($active == 1)
            $car->active = 0;
        else
            $car->active = 1;
        
        if ($this->Cars->save($car)) {
            $this->Flash->success(__('The user has been Status Changed.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function add()
    {
        $car = $this->Cars->newEmptyEntity();
        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $profileImage = $this->request->getData("image");
            $fileName = $profileImage->getClientFilename();
            $fileSize = $profileImage->getSize();
            $data["image"] = $fileName;
            $car = $this->Cars->patchEntity($car, $data);
            if ($this->Cars->save($car)) {
                $hasFileError = $profileImage->getError();

                if ($hasFileError > 0) {
                    $data["image"] = "";
                } else {
                    $fileType = $profileImage->getClientMediaType();

                    if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                        $imagePath = WWW_ROOT . "img/" . $fileName;
                        $profileImage->moveTo($imagePath);
                        $data["image"] = $fileName;
                    }
                }

                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }

        $brands = $this->Users->Brands->find('list', ['limit' => 200])->all()->toArray();
        $this->set(compact('car', 'brands'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => [],
        ]);
        $fileName2 = $car['image'];

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $profileImage = $this->request->getData("image");
            $fileName = $profileImage->getClientFilename();
            if ($fileName == '') {
                $fileName = $fileName2;
            }
            $fileSize = $profileImage->getSize();
            $data["image"] = $fileName;
            $car = $this->Cars->patchEntity($car, $data);
            if ($this->Cars->save($car)) {
                $hasFileError = $profileImage->getError();

                if ($hasFileError > 0) {
                    $data["image"] = "";
                } else {
                    $fileType = $profileImage->getClientMediaType();

                    if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                        $imagePath = WWW_ROOT . "img/" . $fileName;
                        $profileImage->moveTo($imagePath);
                        $data["image"] = $fileName;
                    }
                }
                $this->Flash->success(__('The car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The car could not be saved. Please, try again.'));
        }
        $brands = $this->Users->Brands->find('list', ['limit' => 200])->all()->toArray();
        $this->set(compact('car', 'brands'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $car = $this->Cars->get($id);
        if ($this->Cars->delete($car)) {
            $this->Flash->success(__('The car has been deleted.'));
        } else {
            $this->Flash->error(__('The car could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'register', 'home', 'view']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $user = $this->Authentication->getIdentity();
            if ($user->role == 1) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'home',
                ]);
            } elseif ($user->role == 0) {
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'index',
                ]);
            }

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function home()
    {
        $cars = $this->paginate($this->Cars->find('all')->where(['active' => 1]));
        $key = $this->request->getQuery('key');
        if ($key) {
            $query = $this->Cars->find('all')
                ->where(['Or' => ['company like' => '%' . $key . '%', 'brand like' => '%' . $key . '%', 'model like' => '%' . $key . '%', 'make like' => '%' . $key . '%', 'color like' => '%' . $key . '%']]);
        } else {
            $query = $this->Cars;
        }
        
     
        // $cars = $this->paginate($this->Cars);


        $cars = $this->paginate($query);
        $this->set(compact('cars'));

    }
}
