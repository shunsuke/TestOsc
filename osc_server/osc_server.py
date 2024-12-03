from pythonosc import dispatcher
from pythonosc import osc_server
from pythonosc import osc_message_builder
from pythonosc import udp_client
import logging

# ロギングの設定
logging.basicConfig(filename='osc_server_log.txt', level=logging.DEBUG, format='%(asctime)s %(message)s')


def print_volume_handler(unused_addr, args, volume):
    logging.debug(f"Received message: address={unused_addr}, args={args}, volume={volume}")    


if __name__ == "__main__":
    logging.debug('Start osc_server.py')

    dispatcher = dispatcher.Dispatcher()
    dispatcher.map("/volume", print_volume_handler, 'Volume')
    dispatcher.map("/volume/a", print_volume_handler, 'Volume A')
    dispatcher.map("/volume/a2", print_volume_handler, 'Volume A2')

    server = osc_server.ThreadingOSCUDPServer(("0.0.0.0", 9001), dispatcher)
    print("Serving on {}".format(server.server_address))
    server.serve_forever()