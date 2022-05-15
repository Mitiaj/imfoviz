<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;

final class CsvFile
{
    private string $file;

    /** @var resource */
    private $stream = null;

    private bool $firstLineHeadlines;

    private array $headlines = [];

    final public static function fromFile(UploadedFile $file): self
    {
        return new self($file->path());
    }

    public function __construct(string $file, bool $firstLineHeadlines = true)
    {
        $this->file = $file;
        $this->firstLineHeadlines = $firstLineHeadlines;
    }

    final public function readLine(): array
    {
        $this->ensureOpened();

        $line = fgetcsv($this->stream);

        return $line === false ? [] : $this->buildResponse($line);
    }

    final public function readLineAndReturnPoint(): array
    {
        $this->throwIfClosed();
        $pos = ftell($this->stream);
        $line = fgetcsv($this->stream);
        fseek($this->stream, $pos);

        return $line === false ? [] : $this->buildResponse($line);
    }

    final public function rewind(): void
    {
        $this->throwIfClosed();

        rewind($this->stream);
    }

    public function getHeadlines(): array
    {
        if (!$this->isOpen()) {
            $this->open();
        }

        return $this->headlines;
    }

    private function buildResponse(array $line): array
    {
        if (!$this->firstLineHeadlines) {
            return $line;
        }
        $data = [];
        for ($i = 0; $i < count($this->headlines); $i++) {
            $data[$this->headlines[$i]] = (new TypedValue($line[$i]))->getCastedValue();
        }

        return $data;
    }

    private function ensureOpened(): void
    {
        if (!$this->isOpen()) {
            $this->open();
        }
    }

    private function throwIfClosed(): void
    {
        if (!$this->isOpen()) {
            throw new \BadMethodCallException('Start reading first');
        }
    }

    private function open(): void
    {
        $this->stream = fopen($this->file, 'r+');
        $this->readHeadlines();

    }

    private function readHeadlines(): void
    {
        if ($this->firstLineHeadlines && empty($this->headlines)) {
            $this->headlines = fgetcsv($this->stream);
        }
    }

    private function close(): void
    {
        fclose($this->stream);
    }

    private function isOpen(): bool
    {
        return $this->stream !== null;
    }

    final public function __destruct()
    {
        if ($this->isOpen()) {
            $this->close();
        }
    }
}
