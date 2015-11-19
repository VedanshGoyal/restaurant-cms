<?php

namespace Restaurant\Services;

use Restaurant\Repositories\PhotoRepo;
use Illuminate\Contracts\Filesystem\Filesystem;

class FilesystemService
{
    // @var League\Flysystem\Filesystem
    protected $filesystem;

    // @var string - path to put files in
    protected $path = '/images/uploads/';

    /**
     * Initialize new instance
     *
     * @param PhotoRepo $repo
     * @param Filesystem $filesystem
     */
    public function __construct(PhotoRepo $repo, Filesystem $filesystem)
    {
        $this->repo = $repo;
        $this->filesystem = $filesystem;
    }
    
    /**
     * Add new file
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return bool
     */
    public function add($file)
    {
        $name = rand(111111, 999999);
        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $path = "{$this->path}{$name}.{$extension}";

        if (!$this->filesystem->put($path, file_get_contents($file->getRealPath()))) {
            return false;
        }

        if (!$this->repo->create(['path' => $path])) {
            return false;
        }

        return true;
    }

    /**
     * Remove existing file
     *
     * @param int $id
     * @return bool
     */
    public function remove($id)
    {
        $model = $this->repo->readSingle($id);

        if (!$model || !$this->filesystem->exists($model->path)) {
            return false;
        }

        $this->repo->delete($id);
        $this->filesystem->delete($model->path);

        return true;
    }
}
