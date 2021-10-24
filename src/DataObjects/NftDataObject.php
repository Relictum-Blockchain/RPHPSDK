<?php

namespace Relictum\RPHPSDK\DataObjects;

class NftDataObject extends DefaultDataObject
{
	public function saveFile(string $path, ?string $filename = null) : string
	{
		$nftFile = \Relictum\RPHPSDK\Executor::getRequest($this)->getNftFile($this->data_file_id);
		if($filename !== null) {
			$path = $path . '/' . $filename . '.' . $this->data_file_extension;
		}
		else {
			$path = $path . '/' . $this->newFilename($path, $this->data_file_extension);
		}
		file_put_contents($path, $nftFile->data);
		
		return $path;
	}
	
	protected function newFilename($path, $extension, $length = 20)
	{
		$dir = !empty($directory) && is_dir($directory) ? $directory : dirname(__FILE__);
		do {
			$key = '';
			$keys = array_merge(range(0, 9), range('a', 'z'));

			for ($i = 0; $i < $length; $i++) {
				$key .= $keys[array_rand($keys)];
			}
		} while (file_exists($dir . '/' . $key . (!empty($extension) ? '.' . $extension : '')));

		return $key . (!empty($extension) ? '.' . $extension : '');
	}
}
