<?php namespace App\Repositories;
// model/Repositories/Pokemon/PokemonInterface.php
/**
 * A simple interface to set the methods in our Pokemon repository, nothing much happening here
 * 簡單的介面去設定我們的 Pokemon 資源庫
 */
// interface PokemonInterface
// {
//     public function getPokemonById($pokemonId);
    
//     public function getPokemonByName($pokemonName);
// }


	interface ISearch
	{
		public function setTable();
		public function getResult();
	}