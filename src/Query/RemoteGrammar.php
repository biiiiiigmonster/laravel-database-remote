<?php


namespace BiiiiiigMonster\LaravelDatabaseRemote\Query;


use BiiiiiigMonster\LaravelDatabaseRemote\GrammarNotSupportException;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Grammars\Grammar;

class RemoteGrammar extends Grammar
{
    protected function compileAggregate(Builder $query, $aggregate)
    {
        throw new GrammarNotSupportException("Aggregate grammar not support!");
    }
    protected function compileColumns(Builder $query,$columns)
    {
        return $this->columnize($columns);
    }
    protected function compileFrom(Builder $query, $table)
    {
        return $this->wrapTable($table);
    }
    protected function compileJoins(Builder $query, $joins)
    {
        throw new GrammarNotSupportException("Joins grammar not support!");
    }
    public function compileWheres(Builder $query)
    {
        $params = [];
        foreach ((array)$query->wheres as $where) {
            $params[$where['column']] = $where['value'];
        }

        return \Illuminate\Support\Arr::undot($params);
    }
    protected function compileGroups(Builder $query, $groups)
    {
        throw new GrammarNotSupportException("Groups grammar not support!");
    }
    protected function compileHavings(Builder $query)
    {
        throw new GrammarNotSupportException("Havings grammar not support!");
    }
    protected function compileOrders(Builder $query, $orders)
    {
        throw new GrammarNotSupportException("Orders grammar not support!");
    }
    protected function compileLimit(Builder $query, $limit)
    {
        return (int) $limit;
    }
    protected function compileOffset(Builder $query, $offset)
    {
        throw new GrammarNotSupportException("Offset grammar not support!");
    }
    protected function compileLock(Builder $query, $value)
    {
        throw new GrammarNotSupportException("Lock grammar not support!");
    }

    protected function concatenate($segments)
    {
        return json_encode($segments);
    }

    protected function wrapValue($value)
    {
        return str_replace('"', '""', $value);
    }
}