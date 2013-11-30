<?php

class PictureFileHandler extends sfValidatedFile	{
	public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777) {
		$fileName = parent::save($file, $fileMode, $create, $dirMode);
                Common::makeAdvThumb($fileName);
		return $fileName;
	}
}