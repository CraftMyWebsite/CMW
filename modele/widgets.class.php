<?php

class widgets
{

    private $bdd;
    private $widgets;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
        $req = $bdd->query('SELECT * FROM cmw_widgets ORDER BY ordre ASC');
        $this->widgets = $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWidgets()
    {
        return $this->widgets;
    }

    private function getWidgetsById($id)
    {
        if (!empty($this->widgets)) {
            foreach ($this->widgets as $value) {
                if ($value['id'] == $id) {
                    return $value;
                }
            }
        }
        return null;
    }

    public function upWidgets($id)
    {
        $m = $this->getWidgetsById($id);
        if (!empty($this->widgets)) {
            foreach ($this->widgets as $value) {
                if ($value['ordre'] == $m['ordre'] + 1) {
                    $req = $this->bdd->prepare('UPDATE cmw_widgets SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'] + 1, 'id' => $id));

                    $req = $this->bdd->prepare('UPDATE cmw_widgets SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'], 'id' => $value['id']));
                    return;
                }
            }

        }

    }

    public function downWidgets($id)
    {
        $m = $this->getWidgetsById($id);
        if (!empty($this->widgets)) {
            foreach ($this->widgets as $value) {
                if ($value['ordre'] == $m['ordre'] - 1) {
                    $req = $this->bdd->prepare('UPDATE cmw_widgets SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'] - 1, 'id' => $id));

                    $req = $this->bdd->prepare('UPDATE cmw_widgets SET ordre=:ordre WHERE id=:id');
                    $req->execute(array('ordre' => $m['ordre'], 'id' => $value['id']));
                    return;
                }
            }

        }
    }

    private function getMax()
    {
        $max = 0;
        foreach ($this->widgets as $value) {
            if ($value['ordre'] >= $max) {
                $max = $value['ordre'] + 1;
            }
        }
        return $max;
    }

    public function createWidgets($data)
    {
        $req = $this->bdd->prepare('INSERT INTO cmw_widgets (message, titre, type, ordre) VALUES (:message, :titre, :type, :ordre);');
        $req->execute(array('message' => $data['message'], 'titre' => $data['titre'], 'type' => $data['type'], 'ordre' => $this->getMax()));

        $req = $this->bdd->query('SELECT id FROM cmw_widgets WHERE id= LAST_INSERT_ID()');
        $req = $req->fetch(PDO::FETCH_ASSOC);
        return $req['id'];
    }

    public function supprWidgets($id)
    {
        $m = $this->getWidgetsById($id);
        foreach ($this->widgets as $value) {
            if ($value['ordre'] > $m['ordre']) {
                $req = $this->bdd->prepare('UPDATE cmw_widgets SET ordre=:ordre WHERE id=:id');
                $req->execute(array('ordre' => $value['ordre'] - 1, 'id' => $value['id']));
            }
        }

        $req = $this->bdd->prepare('DELETE FROM cmw_widgets WHERE id=:id');
        $req->execute(array('id' => $id));
    }

    public function editWidgets($data, $id)
    {
        $req = $this->bdd->prepare('UPDATE cmw_widgets SET message=:message, titre=:titre, type=:type WHERE id=:id');
        $req->execute(array('id' => $id, 'message' => $data['message'], 'titre' => $data['titre'], 'type' => $data['type']));
    }

}

?>
