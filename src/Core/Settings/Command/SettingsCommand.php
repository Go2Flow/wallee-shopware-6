<?php declare(strict_types=1);

namespace WalleePayment\Core\Settings\Command;

use Symfony\Component\{
	Console\Command\Command,
    Console\Attribute\AsCommand,
	Console\Input\InputInterface,
	Console\Input\InputOption,
	Console\Output\OutputInterface};
use WalleePayment\Core\{
	Settings\Options\Integration,
	Settings\Service\SettingsService};

/**
 * Class SettingsCommand
 * @internal
 * @package WalleePayment\Core\Settings\Command
 */
#[AsCommand(name: 'wallee:settings:install')]
class SettingsCommand extends Command {

	/**
	 * @var \WalleePayment\Core\Settings\Service\SettingsService
	 */
	protected $settingsService;

	/**
	 * SettingsCommand constructor.
	 * @param \WalleePayment\Core\Settings\Service\SettingsService $settingsService
	 */
	public function __construct(SettingsService $settingsService)
	{
		parent::__construct();
		$this->settingsService = $settingsService;
	}

	/**
	 * @param \Symfony\Component\Console\Input\InputInterface   $input
	 * @param \Symfony\Component\Console\Output\OutputInterface $output
	 * @return int
	 */
	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$output->writeln('Set WalleePayment settings...');
		$this->settingsService->updateSettings([
			SettingsService::CONFIG_APPLICATION_KEY                     => $input->getOption(SettingsService::CONFIG_APPLICATION_KEY),
			SettingsService::CONFIG_EMAIL_ENABLED                       => $input->getOption(SettingsService::CONFIG_EMAIL_ENABLED),
			SettingsService::CONFIG_INTEGRATION                         => $input->getOption(SettingsService::CONFIG_INTEGRATION),
			SettingsService::CONFIG_LINE_ITEM_CONSISTENCY_ENABLED       => $input->getOption(SettingsService::CONFIG_LINE_ITEM_CONSISTENCY_ENABLED),
			SettingsService::CONFIG_SPACE_ID                            => $input->getOption(SettingsService::CONFIG_SPACE_ID),
			SettingsService::CONFIG_SPACE_VIEW_ID                       => $input->getOption(SettingsService::CONFIG_SPACE_VIEW_ID),
			SettingsService::CONFIG_STOREFRONT_INVOICE_DOWNLOAD_ENABLED => $input->getOption(SettingsService::CONFIG_STOREFRONT_INVOICE_DOWNLOAD_ENABLED),
			SettingsService::CONFIG_USER_ID                             => $input->getOption(SettingsService::CONFIG_USER_ID),
			SettingsService::CONFIG_STOREFRONT_WEBHOOKS_UPDATE_ENABLED  => $input->getOption(SettingsService::CONFIG_STOREFRONT_WEBHOOKS_UPDATE_ENABLED),
			SettingsService::CONFIG_STOREFRONT_PAYMENTS_UPDATE_ENABLED  => $input->getOption(SettingsService::CONFIG_STOREFRONT_PAYMENTS_UPDATE_ENABLED),
		]);
		return Command::SUCCESS;
	}

	/**
	 * Configures the current command.
	 */
	protected function configure()
	{
		$this->setDescription('Sets WalleePayment settings.')
			 ->setHelp('This command updates WalleePayment settings for all SalesChannels.')
			 ->addOption(
				 SettingsService::CONFIG_APPLICATION_KEY,
				 SettingsService::CONFIG_APPLICATION_KEY,
				 InputOption::VALUE_REQUIRED,
				 SettingsService::CONFIG_APPLICATION_KEY
			 )
			 ->addOption(
				 SettingsService::CONFIG_SPACE_ID,
				 SettingsService::CONFIG_SPACE_ID,
				 InputOption::VALUE_REQUIRED,
				 SettingsService::CONFIG_SPACE_ID
			 )
			 ->addOption(
				 SettingsService::CONFIG_USER_ID,
				 SettingsService::CONFIG_USER_ID,
				 InputOption::VALUE_REQUIRED,
				 SettingsService::CONFIG_USER_ID
			 )
			 ->addOption(
				 SettingsService::CONFIG_EMAIL_ENABLED,
				 SettingsService::CONFIG_EMAIL_ENABLED,
				 InputOption::VALUE_OPTIONAL,
				 SettingsService::CONFIG_EMAIL_ENABLED,
				 true
			 )
			 ->addOption(
				 SettingsService::CONFIG_INTEGRATION,
				 SettingsService::CONFIG_INTEGRATION,
				 InputOption::VALUE_OPTIONAL,
				 SettingsService::CONFIG_INTEGRATION,
				 Integration::PAYMENT_PAGE
			 )
			 ->addOption(
				 SettingsService::CONFIG_LINE_ITEM_CONSISTENCY_ENABLED,
				 SettingsService::CONFIG_LINE_ITEM_CONSISTENCY_ENABLED,
				 InputOption::VALUE_OPTIONAL,
				 SettingsService::CONFIG_LINE_ITEM_CONSISTENCY_ENABLED,
				 true
			 )
			 ->addOption(
				 SettingsService::CONFIG_STOREFRONT_INVOICE_DOWNLOAD_ENABLED,
				 SettingsService::CONFIG_STOREFRONT_INVOICE_DOWNLOAD_ENABLED,
				 InputOption::VALUE_OPTIONAL,
				 SettingsService::CONFIG_STOREFRONT_INVOICE_DOWNLOAD_ENABLED,
				 true
			 )
			 ->addOption(
				 SettingsService::CONFIG_SPACE_VIEW_ID,
				 SettingsService::CONFIG_SPACE_VIEW_ID,
				 InputOption::VALUE_OPTIONAL,
				 SettingsService::CONFIG_SPACE_VIEW_ID,
				 ''
			 )
			->addOption(
				SettingsService::CONFIG_STOREFRONT_WEBHOOKS_UPDATE_ENABLED,
				SettingsService::CONFIG_STOREFRONT_WEBHOOKS_UPDATE_ENABLED,
				InputOption::VALUE_OPTIONAL,
				SettingsService::CONFIG_STOREFRONT_WEBHOOKS_UPDATE_ENABLED,
				true
			)			->addOption(
				SettingsService::CONFIG_STOREFRONT_PAYMENTS_UPDATE_ENABLED,
				SettingsService::CONFIG_STOREFRONT_PAYMENTS_UPDATE_ENABLED,
				InputOption::VALUE_OPTIONAL,
				SettingsService::CONFIG_STOREFRONT_PAYMENTS_UPDATE_ENABLED,
				true
			);
	}
}
