<?php
class PermissionsManager
{
    protected $json;

    public function __construct(JsonCon $json)
    {
        $this->json = $json;
    }

    public function getGroupsRealTime()
    {
        $groups = $this->json->getGroups();
        return $groups;
    }

    public function updateLocal($perms, $addr)
    {
        $ecriture = new Ecrire($addr, $perms);
    }

    public function getFilePerms($value)
    {
        $perms = $this->json->getFile($value);
        return $perms;
    }

    public function getFilePermsLocal($addr)
    {
        $a = new Lire($addr);
	    return $a->GetTableau();        
    }
}
?>
