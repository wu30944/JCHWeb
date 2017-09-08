<?php 
	namespace App\Repositories;
	use Illuminate\Http\Request;
	use Models\fellowship;

	class fellowshipRepository
	{
		private $dtFellowship;

		public function __construct(fellowship $dtFellowship)
		{
			$this->dtFellowship=$dtFellowship;
		}

		public function getAll()
		{
			return $this->dtFellowship::all();
		}

	
	}
 ?>