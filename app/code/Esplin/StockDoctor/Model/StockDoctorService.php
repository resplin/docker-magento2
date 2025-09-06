<?php
namespace Esplin\StockDoctor\Model;

use Magento\InventoryReservationsApi\Api\GetReservationsListInconsistenciesInterface;
use Magento\InventoryReservationsCleanupApi\Api\CleanupReservationsInterface;

class StockDoctorService
{
    private GetReservationsListInconsistenciesInterface $getInconsistencies;
    private CleanupReservationsInterface $cleanupReservations;

    public function __construct(
        GetReservationsListInconsistenciesInterface $getInconsistencies,
        CleanupReservationsInterface $cleanupReservations
    ) {
        $this->getInconsistencies = $getInconsistencies;
        $this->cleanupReservations = $cleanupReservations;
    }

    /**
     * Scan for inconsistencies
     *
     * @return array
     */
    public function scan(): array
    {
        return $this->getInconsistencies->execute();
    }

    /**
     * Fix selected inconsistencies
     *
     * @param array $inconsistencies
     */
    public function fix(array $inconsistencies = []): void
    {
        $this->cleanupReservations->execute($inconsistencies);
    }

    /**
     * Fix single SKU / stockId
     */
    public function fixReservation(string $sku, int $stockId): void
    {
        $this->cleanupReservations->execute([
            [
                'sku' => $sku,
                'stockId' => $stockId,
            ]
        ]);
    }
}
