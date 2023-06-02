<?php

namespace App\Test\Controller;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CharacterControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CharacterRepository $repository;
    private string $path = '/character/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Character::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Character index');

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
            'character[character_firstname]' => 'Testing',
            'character[character_lastname]' => 'Testing',
            'character[character_nickname]' => 'Testing',
            'character[character_age]' => 'Testing',
            'character[character_job]' => 'Testing',
            'character[character_city]' => 'Testing',
            'character[character_ethnic]' => 'Testing',
            'character[character_link]' => 'Testing',
            'character[character_information]' => 'Testing',
            'character[category_id]' => 'Testing',
        ]);

        self::assertResponseRedirects('/character/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Character();
        $fixture->setCharacter_firstname('My Title');
        $fixture->setCharacter_lastname('My Title');
        $fixture->setCharacter_nickname('My Title');
        $fixture->setCharacter_age('My Title');
        $fixture->setCharacter_job('My Title');
        $fixture->setCharacter_city('My Title');
        $fixture->setCharacter_ethnic('My Title');
        $fixture->setCharacter_link('My Title');
        $fixture->setCharacter_information('My Title');
        $fixture->setCategory_id('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Character');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Character();
        $fixture->setCharacter_firstname('My Title');
        $fixture->setCharacter_lastname('My Title');
        $fixture->setCharacter_nickname('My Title');
        $fixture->setCharacter_age('My Title');
        $fixture->setCharacter_job('My Title');
        $fixture->setCharacter_city('My Title');
        $fixture->setCharacter_ethnic('My Title');
        $fixture->setCharacter_link('My Title');
        $fixture->setCharacter_information('My Title');
        $fixture->setCategory_id('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'character[character_firstname]' => 'Something New',
            'character[character_lastname]' => 'Something New',
            'character[character_nickname]' => 'Something New',
            'character[character_age]' => 'Something New',
            'character[character_job]' => 'Something New',
            'character[character_city]' => 'Something New',
            'character[character_ethnic]' => 'Something New',
            'character[character_link]' => 'Something New',
            'character[character_information]' => 'Something New',
            'character[category_id]' => 'Something New',
        ]);

        self::assertResponseRedirects('/character/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCharacter_firstname());
        self::assertSame('Something New', $fixture[0]->getCharacter_lastname());
        self::assertSame('Something New', $fixture[0]->getCharacter_nickname());
        self::assertSame('Something New', $fixture[0]->getCharacter_age());
        self::assertSame('Something New', $fixture[0]->getCharacter_job());
        self::assertSame('Something New', $fixture[0]->getCharacter_city());
        self::assertSame('Something New', $fixture[0]->getCharacter_ethnic());
        self::assertSame('Something New', $fixture[0]->getCharacter_link());
        self::assertSame('Something New', $fixture[0]->getCharacter_information());
        self::assertSame('Something New', $fixture[0]->getCategory_id());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Character();
        $fixture->setCharacter_firstname('My Title');
        $fixture->setCharacter_lastname('My Title');
        $fixture->setCharacter_nickname('My Title');
        $fixture->setCharacter_age('My Title');
        $fixture->setCharacter_job('My Title');
        $fixture->setCharacter_city('My Title');
        $fixture->setCharacter_ethnic('My Title');
        $fixture->setCharacter_link('My Title');
        $fixture->setCharacter_information('My Title');
        $fixture->setCategory_id('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/character/');
    }
}
