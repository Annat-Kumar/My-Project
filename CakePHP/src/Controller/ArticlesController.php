<?php

// src/Controller/ArticlesController.php

public function add()
{
    $article = $this->Articles->newEntity();
    if ($this->request->is('post')) {
        // Prior to 3.4.0 $this->request->data() was used.
        $article = $this->Articles->patchEntity($article, $this->request->getData());
        // Added this line
        $article->user_id = $this->Auth->user('id');
        // You could also do the following
        //$newData = ['user_id' => $this->Auth->user('id')];
        //$article = $this->Articles->patchEntity($article, $newData);
        if ($this->Articles->save($article)) {
            $this->Flash->success(__('Your article has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('Unable to add your article.'));
    }
    $this->set('article', $article);

    // Just added the categories list to be able to choose
    // one category for an article
    $categories = $this->Articles->Categories->find('treeList');
    $this->set(compact('categories'));
}

?>