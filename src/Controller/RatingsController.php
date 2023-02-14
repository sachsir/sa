<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ratings Controller
 *
 * @property \App\Model\Table\RatingsTable $Ratings
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RatingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
     // public function useradd()
    // {
    //     $user = $this->Users->newEmptyEntity();
    //     if ($this->request->is('post')) {
    //         $data = $this->request->getData();
    //         $user = $this->Users->patchEntity($user, $this->request->getData());
    //         if ($this->Users->save($user)) {
    //             $this->Flash->success(__('The user has been saved.'));

    //             return $this->redirect(['action' => 'usersview']);
    //         }
    //         $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //     }
    //     $this->set(compact('user'));
    // }

    // public function useredit($id = null)
    // {
    //     $user = $this->Authentication->getIdentity();
    //     if ($user->role == 0) {
    //         $user = $this->Users->get($id, [
    //             'contain' => [],
    //         ]);

    //         if ($this->request->is(['patch', 'post', 'put'])) {
    //             $user = $this->Users->patchEntity($user, $this->request->getData());
    //             if ($this->Users->save($user)) {

    //                 $this->Flash->success(__('The user has been saved.'));

    //                 return $this->redirect(['action' => 'usersview']);
    //             }
    //             $this->Flash->error(__('The user could not be saved. Please, try again.'));
    //         }

    //         $this->set(compact('user'));
    //     } else {
    //         return $this->redirect(['action' => 'home']);
    //     }
    // }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Cars'],
        ];
        $ratings = $this->paginate($this->Ratings);

        $this->set(compact('ratings'));
    }

    /**
     * View method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rating = $this->Ratings->get($id, [
            'contain' => ['Users', 'Cars'],
        ]);

        $this->set(compact('rating'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $rating = $this->Ratings->newEmptyEntity();
        if ($this->request->is('post')) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $users = $this->Ratings->Users->find('list', ['limit' => 200])->all();
        $cars = $this->Ratings->Cars->find('list', ['limit' => 200])->all();
        // echo'<pre>';print_r($users);die;

        $this->set(compact('rating', 'users', 'cars'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $rating = $this->Ratings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rating = $this->Ratings->patchEntity($rating, $this->request->getData());
            if ($this->Ratings->save($rating)) {
                $this->Flash->success(__('The rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The rating could not be saved. Please, try again.'));
        }
        $users = $this->Ratings->Users->find('list', ['limit' => 200])->all();
        $cars = $this->Ratings->Cars->find('list', ['limit' => 200])->all();
        $this->set(compact('rating', 'users', 'cars'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Rating id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $rating = $this->Ratings->get($id);
        if ($this->Ratings->delete($rating)) {
            $this->Flash->success(__('The rating has been deleted.'));
        } else {
            $this->Flash->error(__('The rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
