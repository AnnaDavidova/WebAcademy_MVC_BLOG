<?php

namespace Model;

use Model\Driver\Engine;

class Posts implements ModelInterface
{

    use Traits\BaseFunctions;

    const CONNECTION_NAME = 'framework';
    const TABLE_NAME      = 'posts';

    public static function getConnection()
    {
        return Engine::getConnection(self::CONNECTION_NAME);
    }

    public static function create($data = array())
    {
        $connection = self::getConnection();

        $title = isset($data['Title']) ? $data['Title'] : '';
        $text  = isset($data['Text']) ? $data['Text'] : '';

        $statement = $connection->prepare(
            " INSERT INTO ".self::TABLE_NAME."(
                title,
                text
            ) VALUES (
                :title,
                :text
            )"
        );

        $statement->bindValue(':title', $title);
        $statement->bindValue(':text', $text);

        $inserted = $statement->execute();

        if ($inserted) {
            return $connection->lastInsertId(self::TABLE_NAME);
        }

        return false;
    }

    public static function update($id, array $data)
    {
        $connection = self::getConnection();

        $title = isset($data['Name']) ? $data['Name'] : '';
        $text  = isset($data['Text']) ? $data['Text'] : '';

        $statement = $connection->prepare(
            "UPDATE ".self::TABLE_NAME."
             SET
                name = :name,
                text = :text
             WHERE id = :id"
        );

        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->bindValue(':name', $title);
        $statement->bindValue(':text', $text);

        return $statement->execute();
    }

    public static function index($params = array())
    {
        $connection = self::getConnection();

        $limit = isset($params['Limit']) ? " LIMIT $params[Limit] " : '';
        $order = isset($params['SortField']) && isset($params['SortOrder']) ?
            " ORDER BY $params[SortField] $params[SortOrder] " : '';

        $query = "SELECT * FROM ".self::TABLE_NAME.$order.$limit;

        $statement = $connection->prepare($query);

        $success = $statement->execute();

        if ($success) {
            return $statement->fetchAll();
        }

        return false;
    }

    public static function delete($data = array())
    {
        $connection = self::getConnection();

        $ids = isset($data['Id']) && is_array($data['Id'])
            ? $data['Id']
            : [];

        $whereInds = '';
        foreach ($ids as $n => $id) {
            $whereInds .= $n ? ',' : '';
            $whereInds .= ":id_$n";
        }

        $whereInds = $whereInds ? " id IN ($whereInds) " : '';

        if (!$whereInds) {
            return false;
        }

        $statement = $connection->prepare(
            "DELETE FROM ".self::TABLE_NAME." WHERE $whereInds"
        );

        foreach ($ids as $n => $id) {
            $statement->bindValue(":id_$n", $id);
        }

        return $statement->execute();
    }

    public static function selectOne($data = array())
    {
        $connection = self::getConnection();

        $id = isset($data['Id']) ? $data['Id'] : '';

        $statement = $connection->prepare(
            "SELECT *
                FROM ".self::TABLE_NAME."
            WHERE id = :id"
        );

        $statement->bindValue(':id', $id);

        $statement->execute();

        $row = $statement->fetch();

        return $row;
    }

}
