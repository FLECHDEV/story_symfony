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
            'character[firstname]' => 'Testing',
            'character[lastname]' => 'Testing',
            'character[nickname]' => 'Testing',
            'character[age]' => 'Testing',
            'character[job]' => 'Testing',
            'character[city]' => 'Testing',
            'character[ethnic]' => 'Testing',
            'character[link]' => 'Testing',
            'character[information]' => 'Testing',
            'character[category]' => 'Testing',
        ]);

        self::assertResponseRedirects('/character/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Character();
        $fixture->setFirstname('My Title');
        $fixture->setLastname('My Title');
        $fixture->setNickname('My Title');
        $fixture->setAge('My Title');
        $fixture->setJob('My Title');
        $fixture->setCity('My Title');
        $fixture->setEthnic('My Title');
        $fixture->setLink('My Title');
        $fixture->setInformation('My Title');
        $fixture->setCategory('My Title');

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
        $fixture->setFirstname('My Title');
        $fixture->setLastname('My Title');
        $fixture->setNickname('My Title');
        $fixture->setAge('My Title');
        $fixture->setJob('My Title');
        $fixture->setCity('My Title');
        $fixture->setEthnic('My Title');
        $fixture->setLink('My Title');
        $fixture->setInformation('My Title');
        $fixture->setCategory('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'character[firstname]' => 'Something New',
            'character[lastname]' => 'Something New',
            'character[nickname]' => 'Something New',
            'character[age]' => 'Something New',
            'character[job]' => 'Something New',
            'character[city]' => 'Something New',
            'character[ethnic]' => 'Something New',
            'character[link]' => 'Something New',
            'character[information]' => 'Something New',
            'character[category]' => 'Something New',
        ]);

        self::assertResponseRedirects('/character/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getFirstname());
        self::assertSame('Something New', $fixture[0]->getLastname());
        self::assertSame('Something New', $fixture[0]->getNickname());
        self::assertSame('Something New', $fixture[0]->getAge());
        self::assertSame('Something New', $fixture[0]->getJob());
        self::assertSame('Something New', $fixture[0]->getCity());
        self::assertSame('Something New', $fixture[0]->getEthnic());
        self::assertSame('Something New', $fixture[0]->getLink());
        self::assertSame('Something New', $fixture[0]->getInformation());
        self::assertSame('Something New', $fixture[0]->getCategory());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Character();
        $fixture->setFirstname('My Title');
        $fixture->setLastname('My Title');
        $fixture->setNickname('My Title');
        $fixture->setAge('My Title');
        $fixture->setJob('My Title');
        $fixture->setCity('My Title');
        $fixture->setEthnic('My Title');
        $fixture->setLink('My Title');
        $fixture->setInformation('My Title');
        $fixture->setCategory('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/character/');
    }
}
