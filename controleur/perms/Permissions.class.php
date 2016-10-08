<?php
class Permissions
{
    protected $manager, $plugin, $world, $groups, $perms, $key;

    const 
        GROUP_MANAGER = 'groupManager',
        PERMISSION_EX = 'permissionsEx';


    public function getGroups()
    {
        return $this->groups;
    }
    public function getPerms()
    {
        return $this->perms;
    }

    public function hydrate(JsonCon $json, $plugin, $world)
    {
        $this->plugin = $plugin;
        $this->world = $world;
        $this->manager = new PermissionsManager($json);
    } 

    public function readGroupsLocal()
    {
        $i = 0;
        foreach($this->perms as $cle => $element)
        {/*
            $groups[$i] = $cle; */
        }
        $i++;
    }   

    public function readGroupsServer()
    {
        $this->groups = $this->manager->getGroupsRealTime();
    }

    public function readPermsServer()
    {
        if($this->plugin == self::GROUP_MANAGER)
        {
            $value = 'plugins/GroupManager/worlds/'. $this->world .'/groups.yml';
            $this->key = 'groups';
            $ok = true;
        }        

        if($ok){
            $perms = $this->manager->getFilePerms($value);
            if($perms[0]['result'] == 'success')
                $this->perms = $perms[0]['success'];
        }
    }

    public function updateLocal()
    {
        $this->manager->updateLocal($this->perms, 'modele/config/groups.yml');
    }

    public function readPermsLocal()
    {
        $this->perms = $this->manager->getFilePermsLocal('modele/config/groups.yml');
    }

    public function permsToArray()
    {
        $convert = new Lire($this->perms);
	    $convert = $convert->GetTableau();
        if(!empty($this->key))
            $perms = $convert[$this->key];             
       else
            $perms = $convert;            
        $this->perms = $this->reorganiseArray($perms);    
    }

    public function reorganiseArray($perms)
    {
        $i = 0;
            $startPerms = false;
        foreach($perms As $cleGroup => $elementGroup)
        {
            $group[$cleGroup]['isDefault'] = $elementGroup['default'];
            $group[$cleGroup]['canBuild'] = $elementGroup['info']['build'];
            foreach($elementGroup As $cle => $element)
            {        
                if(!empty($cle) AND $cle == 'inheritance')
                    $startPerms = false;
                if($startPerms)
                {
                    $group[$cleGroup]['permissions'][$i] = $element;
                    $i++;
                }

                if(!empty($cle) AND $cle == 'permissions')
                    $startPerms = true;
            }
        }
        return $group;
    }
}
?>
