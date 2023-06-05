<?php

namespace App\Test\Controller;

use App\Entity\Chapter;
use App\Repository\ChapterRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChapterControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ChapterRepository $repository;
    private string $path = '/chapter/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Chapter::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chapter index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'chapter[chapter_ideas]' => 'Testing',
            'chapter[chapter_name]' => 'Testing',
            'chapter[story_id]' => 'Testing',
        ]);

        self::assertResponseRedirects('/chapter/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chapter();
        $fixture->setChapter_ideas('My Title');
        $fixture->setChapter_name('My Title');
        $fixture->setStory_id('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Chapter');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Chapter();
        $fixture->setChapter_ideas('My Title');
        $fixture->setChapter_name('My Title');
        $fixture->setStory_id('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'chapter[chapter_ideas]' => 'Something New',
            'chapter[chapter_name]' => 'Something New',
            'chapter[story_id]' => 'Something New',
        ]);

        self::assertResponseRedirects('/chapter/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getChapter_ideas());
        self::assertSame('Something New', $fixture[0]->getChapter_name());
        self::assertSame('Something New', $fixture[0]->getStory_id());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Chapter();
        $fixture->setChapter_ideas('My Title');
        $fixture->setChapter_name('My Title');
        $fixture->setStory_id('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/chapter/');
    }
}